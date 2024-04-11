<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_FILE = 'file';
    public const TYPE_DATE = 'date';
    public const TYPE_SELECT = 'select';

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string
    {
        if ($this->type === self::TYPE_SELECT) {
            $string = sprintf('<select name="%s" class="form-select %s">',
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : ''
            );

            return sprintf('<select name="%s" class="form-select %s"><option value="">Select</option></select>',
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : ''
            );
        }
        else {
            return sprintf('<input type="%s" name="%s" value="%s" placeholder="%s" class="form-control %s"><div class="invalid-feedback">%s</div>',
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->getLabel($this->attribute),
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->getFirstError($this->attribute)
            );
        }
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField()
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function selectField()
    {
        $this->type = self::TYPE_SELECT;
        return $this;
    }

    public function dateField()
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }
}

