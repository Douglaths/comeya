<?php

if (!function_exists('slugify')) {
    function slugify($text) {
        // Convertir a minúsculas
        $text = strtolower($text);
        
        // Reemplazar caracteres especiales
        $text = str_replace(
            ['á', 'à', 'ä', 'â', 'ã', 'å', 'æ', 'ç', 'é', 'è', 'ë', 'ê', 'í', 'ì', 'ï', 'î', 'ñ', 'ó', 'ò', 'ö', 'ô', 'õ', 'ø', 'ú', 'ù', 'ü', 'û', 'ý', 'ÿ'],
            ['a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'],
            $text
        );
        
        // Eliminar caracteres no alfanuméricos excepto espacios y guiones
        $text = preg_replace('/[^a-z0-9\s\-]/', '', $text);
        
        // Reemplazar espacios múltiples por uno solo
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Reemplazar espacios por guiones
        $text = str_replace(' ', '-', $text);
        
        // Eliminar guiones múltiples
        $text = preg_replace('/-+/', '-', $text);
        
        // Eliminar guiones al inicio y final
        return trim($text, '-');
    }
}