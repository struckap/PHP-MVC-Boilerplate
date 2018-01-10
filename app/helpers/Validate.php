<?php

class Validate 
{
    private $_passed = false,
            $_errors = [],
            $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = [])
    {
        foreach ($items as $item => $rules) 
        {
            if (isset($rules['name'])) 
            {
                $name = $rules['name'];
            } 
            else 
            {
                $name = '"Musis pridat do check() pre "' . $item . '" \'name\' => \'nazov pola ktory chces zobrazit v chybe --- \'"';
            }

            foreach ($rules as $rule => $ruleValue) 
            {
                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) 
                {
                    $this->addError("{$name} je povinný údaj");
                }
                else if(!empty($value))
                {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $ruleValue) 
                            {
                                $this->addError("{$name} sa musí skladať z minimálne {$ruleValue} znakov.");
                            }
                            break;
                      
                        case 'max':
                            if (strlen($value) > $ruleValue) 
                            {
                                $this->addError("{$name} sa musí skladať z maximálne {$ruleValue} znakov.");
                            }
                            break;

                        case 'exact_length':
                            if (strlen($value) != $ruleValue) 
                            {
                                $this->addError("{$name} sa musí skladať z {$ruleValue} znakov.");
                            }
                            break;

                        case 'match':
                            if ($value != $source[$ruleValue]) 
                            {
                                $this->addError("{$name} sa musí zhodovať s {$equalName}.");
                            }
                            break;

                        case 'mail':
                            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) 
                            {
                                $this->addError("{$name} musí byť platná emailová adresa.");
                            }
                            break;

                        case 'password':
                            if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $value)) 
                            {
                                $this->addError("{$name} musí mať od 8 do 20 znakov a musí obsahovať číslicu, malé a veľké písmeno.");
                            }
                            break;

                        case 'number':
                            if (!preg_match('/^[0-9]*$/', $value)) {
                                $this->addError("{$name} sa musí skladať z číslic.");
                            }
                            break;

                        case 'float':
                            if (!preg_match('/^[0-9.]*$/', $value)) {
                                $this->addError("{$name} sa musí skladať z číslic.");
                            }
                            break;

                        case 'minNumVal':
                            if ($value < $ruleValue) 
                            {
                                $this->addError("{$name} nesmie byť väčšie ako {$ruleValue}.");
                            }
                            break;

                        case 'maxNumVal':
                            if ($value > $ruleValue) 
                            {
                                $this->addError("{$name} nesmie byť menšie ako {$ruleValue}.");
                            }
                            break;

                        case 'website':
                            if (!preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',$value)) 
                            {
                                $this->addError("{$name} nie je platná internetová adresa. Zadajte adresu vo formáte www.web.sk alebo http://web.sk");
                            }
                            break; 
         
                    }
                } 
            }
        }

        if (empty($this->_errors)) 
        {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}