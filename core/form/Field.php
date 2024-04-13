<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_TEXTAREA = 'textarea';
    public const TYPE_IMAGE = 'image';
    public const TYPE_DATE = 'date';
    public const TYPE_SELECT = 'select';

    public Model $model;
    public string $attribute;
    public string $type;
    public int $minNumber;
    public int $maxNumber;
    public float $stepNumber;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string
    {
        if ($this->type === self::TYPE_SELECT)
        {
            $string = sprintf('<select name="%s" class="form-select %s">',
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : ''
            );

            foreach ($this->model->getRoles() as $role) {
                $string .= sprintf('<option value="%s" ', $role['role_id']);
                if ($role['role_id'] == $this->model->{$this->attribute}) {
                    $string .= ' selected';
                }
                $string .= sprintf('>%s</option>', $role['roleName']);
            }

            $string .= '</select><div class="invalid-feedback">'.$this->model->getFirstError($this->attribute).'</div>';
        }
        else if ($this->type === self::TYPE_NUMBER)
        {
            $string = sprintf('<input type="%s" name="%s" value="%s" placeholder="%s" class="form-control %s" min="%s" max="%s" step="%s"><div class="invalid-feedback">%s</div>',
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->getLabel($this->attribute),
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->minNumber,
                $this->maxNumber,
                $this->stepNumber,
                $this->model->getFirstError($this->attribute)
            );
        }

        else if ($this->type === self::TYPE_TEXTAREA)
        {
            $string = sprintf('<textarea name="%s" class="form-control %s" placeholder="%s">%s</textarea><div class="invalid-feedback">%s</div>',
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->getLabel($this->attribute),
                $this->model->{$this->attribute},
                $this->model->getFirstError($this->attribute)
            );
        }
        else if ($this->type === self::TYPE_IMAGE)
        {
            $string = sprintf('<input type="file" name="%s" placeholder="%s" class="form-control %s" accept="image/png, image/gif, image/jpeg"><div class="invalid-feedback">%s</div>',
                $this->attribute,
                $this->model->getLabel($this->attribute),
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->getFirstError($this->attribute)
            );
        }
        else
        {
            $string = sprintf('<input type="%s" name="%s" value="%s" placeholder="%s" class="form-control %s"><div class="invalid-feedback">%s</div>',
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->getLabel($this->attribute),
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->getFirstError($this->attribute)
            );
        }
        return $string;
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField()
    {
        $this->type = self::TYPE_IMAGE;
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

    public function numberField(int $min, int $max, float $step)
    {
        $this->type = self::TYPE_NUMBER;
        $this->maxNumber = $max;
        $this->minNumber = $min;
        $this->stepNumber = $step;
        return $this;
    }

    public function textareaField()
    {
        $this->type = self::TYPE_TEXTAREA;
        return $this;
    }
}

