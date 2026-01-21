<?php
// -----------------------------------------------------------------------------
// Validador de datos de entrada.
// -----------------------------------------------------------------------------

/**
 * Clase Validator
 * Contiene funciones de validación específicas del sistema.
 */
class Validator
{
    /**
     * Normaliza un RUT eliminando puntos y espacios.
     *
     * @param string $rut RUT con formato libre.
     * @return string
     */
    public static function normalizeRut(string $rut): string
    {
        // Eliminar puntos y espacios, mantener guión.
        return str_replace(['.', ' '], '', $rut);
    }

    /**
     * Valida un RUT chileno con dígito verificador.
     *
     * @param string $rut RUT en formato 11.111.111-1 o 11111111-1.
     * @return bool
     */
    public static function validateRut(string $rut): bool
    {
        // Limpiar puntos y espacios.
        $rut = self::normalizeRut($rut);

        // Validar formato con guión y dígito verificador.
        if (!preg_match('/^\d{1,8}-[\dkK]$/', $rut)) {
            return false;
        }

        // Separar número y dígito verificador.
        [$number, $dv] = explode('-', $rut);
        $dv = strtolower($dv);

        // Calcular dígito verificador esperado.
        $sum = 0;
        $multiplier = 2;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += (int)$number[$i] * $multiplier;
            $multiplier = ($multiplier === 7) ? 2 : $multiplier + 1;
        }

        $rest = $sum % 11;
        $expected = 11 - $rest;

        if ($expected === 11) {
            $expectedDv = '0';
        } elseif ($expected === 10) {
            $expectedDv = 'k';
        } else {
            $expectedDv = (string)$expected;
        }

        // Comparar dígito verificador esperado con el recibido.
        return $dv === $expectedDv;
    }
}
