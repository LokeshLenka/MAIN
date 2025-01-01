@extends('layouts.app')

{{-- @section('content') --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }}'s Followers
                    <span class="badge bg-secondary">{{ $followers->total() }}</span>
                </div>

                <div class="card-body">
                    @foreach ($followers as $follow)
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                @if ($follow->follower->avatar)
                                    <img src="{{ $follow->follower->avatar }}" class="rounded-circle me-3"
                                        width="50">
                                @endif
                                <div>
                                    <h5 class="mb-0">
                                        {{-- <a href="{{ route('profile', $follow->follower) }}" --}}
                                            class="text-decoration-none">
                                            {{ $follow->follower->name }}
                                        </a>
                                    </h5>
                                    <small class="text-muted">Followed
                                        {{ $follow->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            @auth
                                @if (auth()->id() !== $follow->follower->id)
                                    @if (auth()->user()->isFollowing($follow->follower))
                                        <button class="btn btn-sm btn-secondary unfollow-btn"
                                            data-user-id="{{ $follow->follower->id }}">
                                            Unfollow
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-primary follow-btn"
                                            data-user-id="{{ $follow->follower->id }}">
                                            Follow
                                        </button>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $followers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
