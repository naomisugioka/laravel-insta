@extends('layouts.app')

@section('title','Admin:Users')

@section('content')

<form action="{{ route('admin.users')}}" method="get" class="ms-auto mb-3" style="width:12rem">
    <input type="text" name="search" placeholder="search for user" value="{{ $search}}" class="form-control">
</form><br>

<table class="table table-hover text-secondary bg-white border align-middle">
    <thead class="text-secondary table-success small text-uppercase">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($all_users as $user)
        <tr>
            <td>
                @if($user->avatar)
                <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-md d-block mx-auto">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-md d-block text-center"></i>
                @endif
            </td>
            <td>
                <a href=" {{ route('profile.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $user->name}}</a>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                @if($user->trashed())
                  <i class="fa-regular fa-circle"></i>Inactive
                 @else 
                <i class="fa-solid fa-circle text-success"></i>Active
                @endif
            </td>
            <td>
                @if($user->id !=Auth::user()->id)
                <div class="dropdown">
                <button class="btn" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    @if($user->trashed())
                    {{--activate--}}
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user{{ $user->id}}">
                        <i class="fa-solid fa-user-check"></i>Activate{{ $user->name }}
                    </button>
                    @else
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user{{ $user->id}}">
                        <i class="fa-solid fa-user-slash"></i> Deactivate User {{ $user->name }}
                    </button>
                    @endif
                </div>
            </div>
                @include('admin.users.modals')
                @endif
            </td>

        </tr>

        @empty
        <tr>
            <td class="text-center" colspan="6">No users found.</td>
        </tr>

        @endforelse
    </tbody>
</table>
{{ $all_users->links()}}
@endsection