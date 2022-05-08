<?php

use App\Constants\AppConstant;

//SLUGGABLE WORDS
if (!function_exists('getReadable')) {
    function getReadable($text)
    {
        return ucwords(str_replace('_', ' ', $text));
    }
}

//DATATABLE BUTTONS
if (!function_exists('dtViewButton')) {
    function dtViewButton($url)
    {
        return view(
            'theme.components.buttons.view',
            ['url' => $url]
        );
    }
}
if (!function_exists('dtEditButton')) {
    function dtEditButton($url)
    {
        return view(
            'theme.components.buttons.edit',
            ['url' => $url]
        );
    }
}
if (!function_exists('dtDeleteButton')) {
    function dtDeleteButton($url)
    {
        return view(
            'theme.components.buttons.delete',
            ['url' => serialize($url)]
        );
    }
}
//---------- END DATATABLE BUTTONS

if (!function_exists('saveButton')) {
    function saveButton($text = null)
    {
        return view(
            'theme.components.buttons.form.save',
            ['text' => $text]
        );
    }
}

if (!function_exists('updateButton')) {
    function updateButton($text = null)
    {
        return view(
            'theme.components.buttons.form.update',
            ['text' => $text]
        );
    }
}

if (!function_exists('deleteButton')) {
    function deleteButton($url)
    {
        return view(
            'theme.components.buttons.form.delete',
            ['url' => serialize($url)]
        );
    }
}


if (!function_exists('resetButton')) {
    function resetButton($text = null)
    {
        return view(
            'theme.components.buttons.form.reset',
            ['text' => $text]
        );
    }
}

if (!function_exists('backButton')) {
    function backButton($text = null)
    {
        return view(
            'theme.components.buttons.form.back',
            ['text' => $text]
        );
    }
}

if (!function_exists('errorMessage')) {
    function errorMessage($errors, string $field)
    {
        if ($errors->has($field)) {
            return '<span id="fv-full-' . $field . '" class="invalid">' . $errors->first($field) . '</span>';
        }
        return null;
    }
}

if (!function_exists('errorClass')) {
    function errorClass($errors, string $field)
    {
        if ($errors->has($field)) {
            return "is-invalid";
        }
        return null;
    }
}

if (!function_exists('getTranslation')) {

    function getTranslation($model, $locale = 'en', $column = 'name')
    {
        if ($model) {
            return $model->translate($column, $locale);
        }
        return null;
    }
}


if (!function_exists('withDefaults')) {
    function withDefaults($records, $message = '- Please Select -')
    {
        if (is_array($records)) {
            //            return array_merge(['' => '- Please Select -'], $records);
            return ['' => $message] + $records;
        }
        return $records->prepend($message, '');
    }
}

if (!function_exists('withDefaultsOnly')) {
    function withDefaultsOnly($records)
    {
        if (is_array($records)) {
            return $records;
        }
        return $records;
    }
}


if (!function_exists('transSelect')) {
    function transSelect($records, $column)
    {
        $result = [];
        foreach ($records as $record) {
            $result[$record->id] = $record->translate($column, 'en');
        }
        return withDefaults($result);
    }
}


if (!function_exists('checkPermission')) {
    function checkPermission($permission)
    {
        $permission = preg_replace('/[^A-Za-z0-9\-]/', '', $permission);
        $authUser = Auth::user();

        // dd($authUser->role->all);

        if ($authUser->role->all == 1) {
            return true;
        }

        $userPermissions = $authUser->role->permissions->pluck('name')->toArray();
        foreach ($userPermissions as $uPermission) {
            if ($uPermission == $permission) {
                return true;
            }
        }
        return false;
    }
}

// model code

if (!function_exists('code')) {
    function code()
    {
        return app('code');
    }
}

if (!function_exists('state')) {
    function state()
    {
        return app('state');
    }
}

if (!function_exists('access')) {
    function access()
    {
        return app('access');
    }
}

if (!function_exists('stateBatch')) {
    function stateBatch($state)
    {
        return '<span class="tb-status ' . strtolower($state) . ' ">' . $state . '</span>';
    }
}
