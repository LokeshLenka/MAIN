<x-app-layout>

    {{-- @section('content') --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        People {{ $user->name }} Follows
                        <span class="badge bg-secondary">{{ $following->total() }}</span>
                    </div>

                    <div class="card-body">
                        @foreach ($following as $follow)
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    @if ($follow->following->avatar)
                                        <img src="{{ $follow->following->avatar }}" class="rounded-circle me-3"
                                            width="50">
                                    @endif
                                    <div>
                                        <h5 class="mb-0">
                                            {{-- <a href="{{ route('profile', $follow->following) }}" --}}
                                                class="text-decoration-none">
                                                {{ $follow->following->name }}
                                            </a>
                                        </h5>
                                        <small class="text-muted">Following since
                                            {{ $follow->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>

                                @auth
                                    @if (auth()->id() !== $follow->following->id)
                                        @if (auth()->user()->isFollowing($follow->following))
                                            <button class="btn btn-sm btn-secondary unfollow-btn"
                                                data-user-id="{{ $follow->following->id }}">
                                                Unfollow
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-primary follow-btn"
                                                data-user-id="{{ $follow->following->id }}">
                                                Follow
                                            </button>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        @endforeach

                        <div class="mt-4">
                            {{ $following->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-layout>
