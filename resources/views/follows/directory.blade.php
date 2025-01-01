<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">User Directory</h4>
                            <form action="{{ route('user.directory') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control form-control-sm me-2"
                                    placeholder="Search users..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($users->isEmpty())
                            <p class="text-center">No users found.</p>
                        @else
                            @foreach ($users as $user)
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-bottom">
                                    <div class="d-flex align-items-center">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar }}" class="rounded-circle me-3" width="50">
                                        @else
                                            <div class="rounded-circle me-3 bg-secondary text-white d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <h5 class="mb-0">
                                                {{-- <a href="{{ route('profile', $user) }}" class="text-decoration-none"> --}}
                                                {{ $user->name }}
                                                </a>
                                            </h5>
                                            <small class="text-muted">
                                                {{ $user->followers_count }} Followers · {{ $user->following_count }}
                                                Following
                                            </small>
                                        </div>
                                    </div>

                                    @auth
                                        @if (auth()->id() !== $user->id)
                                            <div class="follow-button-container">
                                                <form action="{{ route('follow') }}" method="post">
                                                    @csrf
                                                    @if (auth()->user()->isFollowing($user))
                                                        <input type="hidden" value="{{ $user->id }}" name />
                                                        <button class="btn btn-sm btn-secondary unfollow-btn"
                                                            data-user-id="{{ $user->id }}" type="submit">
                                                            Unfollow
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-primary follow-btn"
                                                            data-user-id="{{ $user->id }}" type="submit">
                                                            Follow
                                                        </button>
                                                </form>
                                        @endif
                                    </div>
                                @endif
                            @endauth
                    </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $users->withQueryString()->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateFollowButton(button, isFollowing) {
            if (isFollowing) {
                button.classList.remove('btn-primary', 'follow-btn');
                button.classList.add('btn-secondary', 'unfollow-btn');
                button.textContent = 'Unfollow';
            } else {
                button.classList.remove('btn-secondary', 'unfollow-btn');
                button.classList.add('btn-primary', 'follow-btn');
                button.textContent = 'Follow';
            }
        }

        // Handle follow button clicks
        document.addEventListener('click', function(e) {
            if (e.target.matches('.follow-btn, .unfollow-btn')) {
                const button = e.target;
                const userId = button.dataset.userId;
                const isUnfollow = button.classList.contains('unfollow-btn');
                const url = isUnfollow ? `/unfollow/${userId}` : `/follow/${userId}`;
                const method = isUnfollow ? 'DELETE' : 'POST';

                fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateFollowButton(button, !isUnfollow);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>
