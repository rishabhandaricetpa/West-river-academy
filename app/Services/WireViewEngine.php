<?php

namespace App\Services;

class WireViewEngine
{
    /**
     * Content for the view
     */
    private $content = '';

    /**
     * key, value pair of legends
     * ["student_name" => "Risha"]
     */
    private $legends = [];

    /**
     * Get a new instance
     */
    function __construct($content)
    {
        $this->content = $content;

    }

    /**
     * Get raw contents
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set all legends
     */
    public function setLegends($legends)
    {
        $this->legends = $legends;
        return $this;
    }

    /**
     * Render  output to plain text
     */
    public function render()
    {
        foreach ($this->legends as $key => $value) {
            $this->content = str_replace($key, $value, $this->content);
        }
        return $this->content;
    }
}
