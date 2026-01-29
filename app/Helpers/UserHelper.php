<?php

if (!function_exists('user')) {
    /**
     * Get authenticated user data dengan shortcut
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     *
     * Usage:
     * user()              -> return User object
     * user('id')          -> return user ID
     * user('first')       -> return first_name
     * user('last')        -> return last_name
     * user('full')        -> return "First Last"
     * user('name')        -> return "First Last" (alias full)
     * user('email')       -> return email
     * user('username')    -> return username
     * user('phone')       -> return phone
     * user('gender')      -> return gender
     * user('is_active')   -> return is_active
     * user('avatar')      -> return avatar path (nanti)
     */
    function user($key = null, $default = null)
    {
        $user = auth()->user();

        if (!$user) {
            return $default;
        }

        // Jika tidak ada key, return user object
        if (is_null($key)) {
            return $user;
        }

        // Handle berbagai shortcut
        switch ($key) {
            case 'id':
                return $user->id;

            case 'first':
            case 'first_name':
            case 'firstname':
                return $user->first_name ?? $default;

            case 'last':
            case 'last_name':
            case 'lastname':
                return $user->last_name ?? $default;

            case 'full':
            case 'name':
            case 'full_name':
            case 'fullname':
                return trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: $default;

            case 'email':
                return $user->email ?? $default;

            case 'username':
                return $user->username ?? $default;

            case 'phone':
                return $user->phone ?? $default;

            case 'gender':
                return $user->gender ?? $default;

            case 'is_active':
            case 'active':
                return $user->is_active ?? $default;

            case 'avatar':
                return $user->avatar ?? $default;

            case 'registration_type':
                return $user->registration_type ?? $default;

            case 'last_activity':
                return $user->last_activity ?? $default;

            case 'email_verified':
            case 'verified':
                return $user->email_verified_at !== null;

            case 'created':
            case 'created_at':
                return $user->created_at ?? $default;

            case 'updated':
            case 'updated_at':
                return $user->updated_at ?? $default;

            // Jika key adalah property yang ada di user
            default:
                return $user->{$key} ?? $default;
        }
    }
}

if (!function_exists('userId')) {
    /**
     * Shortcut untuk user ID
     *
     * @return string|null
     */
    function userId()
    {
        return auth()->id();
    }
}

if (!function_exists('userName')) {
    /**
     * Shortcut untuk full name
     *
     * @return string
     */
    function userName()
    {
        return user('full', 'Guest');
    }
}

if (!function_exists('userEmail')) {
    /**
     * Shortcut untuk email
     *
     * @return string|null
     */
    function userEmail()
    {
        return user('email');
    }
}

if (!function_exists('isUserActive')) {
    /**
     * Cek apakah user aktif
     *
     * @return bool
     */
    function isUserActive()
    {
        return user('is_active') == 1;
    }
}

if (!function_exists('isEmailVerified')) {
    /**
     * Cek apakah email sudah verified
     *
     * @return bool
     */
    function isEmailVerified()
    {
        return user('verified', false);
    }
}

if (!function_exists('userGender')) {
    /**
     * Get user gender dengan format yang readable
     *
     * @param string $format - 'full', 'short', 'icon'
     * @return string
     */
    function userGender($format = 'full')
    {
        $gender = user('gender');

        if (!$gender) {
            return '-';
        }

        switch ($format) {
            case 'full':
                return $gender === 'male' ? 'Laki-laki' : 'Perempuan';

            case 'short':
                return $gender === 'male' ? 'L' : 'P';

            case 'icon':
                return $gender === 'male'
                    ? '<i class="ri-men-line text-primary"></i>'
                    : '<i class="ri-women-line text-danger"></i>';

            default:
                return $gender;
        }
    }
}

if (!function_exists('userInitial')) {
    /**
     * Get user initial dari nama
     *
     * @return string
     */
    function userInitial()
    {
        $firstName = user('first');
        $lastName = user('last');

        if (!$firstName) {
            return user('username') ? strtoupper(substr(user('username'), 0, 1)) : '?';
        }

        $initial = strtoupper(substr($firstName, 0, 1));

        if ($lastName) {
            $initial .= strtoupper(substr($lastName, 0, 1));
        }

        return $initial;
    }
}

if (!function_exists('hasRole')) {
    /**
     * Cek apakah user punya role tertentu
     *
     * @param string|array $role
     * @return bool
     */
    function hasRole($role)
    {
        $user = user();

        if (!$user) {
            return false;
        }

        if (method_exists($user, 'hasRole')) {
            return $user->hasRole($role);
        }

        return false;
    }
}

if (!function_exists('hasPermission')) {
    /**
     * Cek apakah user punya permission tertentu
     *
     * @param string|array $permission
     * @return bool
     */
    function hasPermission($permission)
    {
        $user = user();

        if (!$user) {
            return false;
        }

        if (method_exists($user, 'hasPermissionTo')) {
            return $user->hasPermissionTo($permission);
        }

        return false;
    }
}

if (!function_exists('lastActivity')) {
    /**
     * Get last activity dalam format human readable
     *
     * @return string
     */
    function lastActivity()
    {
        $lastActivity = user('last_activity');

        if (!$lastActivity) {
            return 'Tidak ada aktivitas';
        }

        return \Carbon\Carbon::parse($lastActivity)->diffForHumans();
    }
}

if (!function_exists('userAge')) {
    /**
     * Get user age jika ada tanggal lahir
     * Ini untuk future jika nanti ada field birth_date
     *
     * @return int|null
     */
    function userAge()
    {
        $birthDate = user('birth_date');

        if (!$birthDate) {
            return null;
        }

        return \Carbon\Carbon::parse($birthDate)->age;
    }
}

if (!function_exists('isGuest')) {
    /**
     * Cek apakah user adalah guest (belum login)
     *
     * @return bool
     */
    function isGuest()
    {
        return !auth()->check();
    }
}

if (!function_exists('isAuthenticated')) {
    /**
     * Cek apakah user sudah login
     *
     * @return bool
     */
    function isAuthenticated()
    {
        return auth()->check();
    }
}


// penggunaan
// {{-- Get specific data --}}
// <p>ID: {{ user('id') }}</p>
// <p>First Name: {{ user('first') }}</p>
// <p>Last Name: {{ user('last') }}</p>
// <p>Full Name: {{ user('full') }}</p>
// <p>Email: {{ user('email') }}</p>
// <p>Username: {{ user('username') }}</p>
// <p>Phone: {{ user('phone') }}</p>
// <p>Gender: {{ userGender('full') }}</p>
// <p>Initial: {{ userInitial() }}</p>
// <p>Status: {{ isUserActive() ? 'Active' : 'Inactive' }}</p>

// {{-- Dengan default value --}}
// <p>Phone: {{ user('phone', 'Tidak ada nomor telepon') }}</p>

// {{-- Shortcut functions --}}
// <p>User ID: {{ userId() }}</p>
// <p>User Name: {{ userName() }}</p>
// <p>User Email: {{ userEmail() }}</p>

// {{-- Check conditions --}}
// @if(isAuthenticated())
//     <p>Welcome, {{ userName() }}!</p>
// @endif

// @if(isUserActive())
//     <span class="badge bg-success">Active</span>
// @else
//     <span class="badge bg-danger">Inactive</span>
// @endif

// @if(isEmailVerified())
//     <i class="ri-verified-badge-line text-success"></i>
// @endif

// {{-- Gender dengan icon --}}
// <p>Gender: {!! userGender('icon') !!}</p>

// {{-- Last activity --}}
// <p>Last Activity: {{ lastActivity() }}</p>