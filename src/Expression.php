<?php
/**
 * A PHP client library for accessing Comindware Tracker API.
 *
 * @copyright 2016, Comindware, http://comindware.com/
 * @license   http://opensource.org/licenses/MIT MIT
 */
namespace Comindware\Tracker\API;

/**
 * Comindware Expression Language helper.
 *
 * @api
 * @see   http://kb.comindware.com/comindware-tracker/1.0/comindware-expression-language-how-to/
 * @since x.x
 */
class Expression
{
    /**
     * Equality.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     *
     * @since x.x
     */
    public static function eq($a, $b)
    {
        return sprintf('EQUALS(%s, %s)', $a, $b);
    }

    /**
     * Object field literal.
     *
     * @param string $a
     *
     * @return string
     *
     * @since x.x
     */
    public static function field($a)
    {
        return '$' . $a;
    }

    /**
     * Logical AND.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     *
     * @since x.x
     */
    public static function lAnd($a, $b)
    {
        return sprintf('AND(%s, %s)', $a, $b);
    }

    /**
     * Object identifier.
     *
     * @param string $a
     *
     * @return string
     *
     * @since x.x
     */
    public static function id($a)
    {
        return sprintf('ID(%s)', $a);
    }

    /**
     * Logical NOT.
     *
     * @param string $a
     *
     * @return string
     *
     * @since x.x
     */
    public static function not($a)
    {
        return sprintf('NOT(%s)', $a);
    }

    /**
     * Not equal.
     *
     * @param string $a
     * @param string $b
     *
     * @return string
     *
     * @since x.x
     */
    public static function notEq($a, $b)
    {
        return sprintf('NOTEQUALS(%s, %s)', $a, $b);
    }

    /**
     * String literal.
     *
     * @param mixed $a
     *
     * @return string
     *
     * @since x.x
     */
    public static function str($a)
    {
        return '"' . str_replace('"', '\\"', $a) . '"';
    }
}
