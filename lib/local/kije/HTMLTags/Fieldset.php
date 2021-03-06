<?php


namespace kije\HTMLTags;

/**
 * Class Fieldset
 * @package kije\HTMLTags
 */
class Fieldset extends Formfield
{
    protected $tagname = 'fieldset';
    protected $selfclosing = false;
    protected $requiredAttributes = array();

    /**
     * @var Formfield[] $fields
     */
    protected $fields = array();


    /**
     * @return array
     */
    public function getAllowedAttributes()
    {
        return array_unique(
            array_merge(
                parent::getAllowedAttributes(),
                array(
                    'disabled',
                    'form',
                    'name'
                )
            )
        );
    }

    /**
     * Add a Formfield to this fieldset
     * @param Formfield  $field
     * @param int|string $key
     */
    public function addField(Formfield $field, $key = null)
    {
        if ($key != null) {
            $this->fields[$key] = $field;
        } else {
            $this->fields[] = $field;
        }
    }

    /**
     * Remove a formfield
     * @param $key
     */
    public function removeField($key)
    {
        unset($this->fields[$key]);
    }

    protected function updateInnerHTML()
    {
        $this->innerHTML = '<legend>'.$this->getCaption().'</legend>';

        foreach ($this->getFields() as $field) {
            $this->innerHTML .= sprintf('<label>%s %s</label>', $field->toHTML(), $field->getCaption());
        }
    }

    /**
     * @return Formfield[]
     */
    public function getFields()
    {
        return $this->fields;
    }
}
