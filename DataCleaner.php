<?php

class DataCleaner
{
    /**
     * @param $data
     * @return string
     */
    public function dataClean($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
}
