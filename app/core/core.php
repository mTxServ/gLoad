<?php
/**
 * Write a new $value in a $param for an .ini file
 * Gist : https://gist.github.com/Gabyfle/3ea2a2ec1125f967fc06736c91d27df9
 *
 * @param string $path path of the .ini file
 * @param string $param parameter to change
 * @param string $value value to put in $param
 */
function write_ini_file(string $path, string $param, string $value)
{
    $parsedFile = parse_ini_file($path, true);
    $contents = '';

    foreach ($parsedFile as $sectionKey => $sectionValue)
    {
        if(is_array($sectionValue)) {
            $contents .= "[" . $sectionKey . "]\n";
            foreach ($sectionValue as $paramKey => $paramValue) {
                if ($paramKey == $param)
                {
                    $contents .= $paramKey . " = " . $value . "\n";
                } else {
                    $contents .= $paramKey . " = " . $paramValue . "\n";
                }
            }
        } else {
            if ($sectionKey == $param)
            {
                $contents .= $sectionKey . " = " . $value . "\n";
            } else {
                $contents .= $sectionKey . " = " . $sectionValue . "\n";
            }
        }
    }

    file_put_contents($path, $contents);
}