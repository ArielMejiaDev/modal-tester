<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsersController extends Controller
{
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });

        $users = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email', $globalSearch])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Users/Index', [
            'users' => $users,
        ])->table(function (InertiaTable $table) {
            $table
                ->withGlobalSearch()
                ->defaultSort('name')
                ->column(key: 'name', canBeHidden: false, sortable: true, searchable: true)
                ->column(key: 'email', sortable: true, searchable: true);
        });
    }

    public function create()
    {
        return Inertia::modal('Users/CreateModal')
            ->baseRoute('users.index');
    }

    public function store(StoreUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        User::query()->create($request->validated());
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
