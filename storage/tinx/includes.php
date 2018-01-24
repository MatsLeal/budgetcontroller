<?php

use Ajthinking\Tinx\Console\State;

/**
 * Restarts Tinker.
 *
 * @return  void
 * */
function re() {
    State::requestRestart();
    exit();
}

/**
 * Restart aliases.
 * */
function reboot() {
    re();
}
function reload() {
    re();
}
function restart() {
    re();
}

/**
 * Renders the "Class/Shortcuts" names table.
 *
 * @param  array $args If passed, filters classes to these terms (e.g. "names('banana', 'carrot')").
 * @return  void
 * */
function names(...$args) {
    event('tinx.names', $args);
}

/**
 * @param  string $class
 * @return  void
 * */
function tinx_forget_name($class) {
    array_forget($GLOBALS, "tinx.names.$class");
}

/**
 * Magic query method to handle all "u(x [y, z])" calls.
 *
 * @param  string $class
 * @param  mixed $args
 * @return  mixed
 * */
function tinx_query($class, ...$args)
{
    $totalArgs = count($args);

    /**
     * Zero arguments (i.e. u() returns "App\User").
     * */
    if ($totalArgs === 0) {
        return $class; // Return a clean starting point for the query builder.
    }

    /**
     * One argument (i.e. u(2) returns App\User::find(2)).
     * */
    if ($totalArgs === 1) {
        $arg = $args[0];

        /**
         * Int? Use "find()".
         * */
        if (is_int($arg)) {
            return $class::find($arg);
        }

        /**
         * String? Search all columns.
         * */
        if (is_string($arg)) {
            if ($class::first() === null) {
                throw new Exception(
                    "You can only search where there is data. ".
                    "There is no way for Tinx to get a column listing ".
                    "for a model without an existing instance…");
            }
            $columns = Schema::getColumnListing($class::first()->getTable());
            $query = $class::select('*');
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%'.$arg.'%');
            }
            return $query->get();
        }

        throw new Exception("Don't know what to do with this datatype. Please make PR.");
    }

    /**
     * The query builder's "where" method accepts up to 4 arguments, but let's lock it to 3.
     * Two arguments (i.e. u("name", "Anders") returns App\User::where("name", "Anders")).
     * Three arguments (i.e. u("id", ">", 1) returns App\User::where("id", ">", 1)).
     * */
    if ($totalArgs >= 2 && $totalArgs <= 3) {
        return $class::where(...$args)->get();
    }
    
    throw new Exception("Too many arguments!");
}

/**
 * Insert "first" and "last" variables (e.g. '$u', '$u_', etc) and model functions (e.g. 'u()', etc).
 * For "first" variable, returns "::first()" if class DB table exists, otherwise "new" (if 'tableless_models' set to true).
 * For "last" variable, returns "::latest()->first()" if class DB table exists, otherwise "new" (if 'tableless_models' set to true).
 * */
array_set($GLOBALS, 'tinx.names', array (
  'App\\Incoming' => 'i',
  'App\\User' => 'u',
  'App\\expenses' => 'ex',
  'App\\expenses_type' => 'et',
  'App\\incomings_type' => 'it',
));
$latestColumn = 'created_at';
    try {
        $i = App\Incoming::first() ?: app('App\Incoming');
        $i_ = App\Incoming::latest($latestColumn)->first() ?: app('App\Incoming');
        if (!function_exists('i')) {
            function i(...$args) {
                return tinx_query('App\Incoming', ...$args);
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('App\Incoming');
    } catch (Exception $e) {
        tinx_forget_name('App\Incoming');
    }
    try {
        $u = App\User::first() ?: app('App\User');
        $u_ = App\User::latest($latestColumn)->first() ?: app('App\User');
        if (!function_exists('u')) {
            function u(...$args) {
                return tinx_query('App\User', ...$args);
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('App\User');
    } catch (Exception $e) {
        tinx_forget_name('App\User');
    }
    try {
        $ex = App\expenses::first() ?: app('App\expenses');
        $ex_ = App\expenses::latest($latestColumn)->first() ?: app('App\expenses');
        if (!function_exists('ex')) {
            function ex(...$args) {
                return tinx_query('App\expenses', ...$args);
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('App\expenses');
    } catch (Exception $e) {
        tinx_forget_name('App\expenses');
    }
    try {
        $et = App\expenses_type::first() ?: app('App\expenses_type');
        $et_ = App\expenses_type::latest($latestColumn)->first() ?: app('App\expenses_type');
        if (!function_exists('et')) {
            function et(...$args) {
                return tinx_query('App\expenses_type', ...$args);
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('App\expenses_type');
    } catch (Exception $e) {
        tinx_forget_name('App\expenses_type');
    }
    try {
        $it = App\incomings_type::first() ?: app('App\incomings_type');
        $it_ = App\incomings_type::latest($latestColumn)->first() ?: app('App\incomings_type');
        if (!function_exists('it')) {
            function it(...$args) {
                return tinx_query('App\incomings_type', ...$args);
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('App\incomings_type');
    } catch (Exception $e) {
        tinx_forget_name('App\incomings_type');
    }
unset($latestColumn);

/**
 * Quick reference array.
 * */
$names = array_get($GLOBALS, 'tinx.names');
