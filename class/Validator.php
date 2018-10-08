<?php

/**
 * Description of Validator
 *
 * @author official
 */
class Validator {

    private $_passed = false,
            $_errors = array();

    public function check($source, $items = array()) {


        foreach ($items as $item => $rules) {

            foreach ($rules as $rule => $rule_value) {


                $value = trim($source->$item);

                if ($rule === "required" && empty($value)) {

                    $message = "{$item} is required";
                    $status = "danger";
                    $this->addError($message, $status);
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $message = "{$item} must be a minimum of {$rule_value} characters.";
                                $status = "danger";
                                $this->addError($message, $status);
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $message = "{$item} must be a maximum of {$rule_value} characters.";
                                $status = "danger";
                                $this->addError($message, $status);
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $message = "{$rule_value} must match {$item}";
                                $status = "danger";
                                $this->addError($message, $status);
                            }
                            break;
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $message = "{$rule_value} invalid email format {$item}";
                                $status = "danger";
                                $this->addError($message, $status);
                            }
                            break;
                        case 'numeric':
                            if (!is_numeric($value)) {
                                $message = "{$item} must be numeric ";
                                $status = "danger";
                                $this->addError($message, $status);
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = TRUE;
        }
        return $this;
    }

    public function addError($message, $status) {
        $this->_errors[] = ['message' => $message, 'status' => $status];
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

    public function show_message() {

        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['ERRORS'])) {
            foreach ($_SESSION['ERRORS'] as $error) {
                ?>
                <div class="alert alert-<?php echo $error["status"]; ?>">
                    <strong><?php echo ucfirst($error["status"]); ?> : </strong> 
                <?php echo ucfirst($error["message"]); ?>!.
                </div>
                <?php
            }
            unset($_SESSION['ERRORS']);
        }
    }

}