@if (auth()->check() && auth()->id() !== $user->id)
    @if (auth()->user()->isFollowing($user))
        <button class="unfollow-btn" data-user-id="{{ $user->id }}">Unfollow</button>
    @else
        <button class="follow-btn" data-user-id="{{ $user->id }}">Follow</button>
    @endif
@endif


<div class="stats">
    <div>Followers: {{ $user->followers()->count() }}</div>
    <div>Following: {{ $user->following()->count() }}</div>
</div>


<script>
    // Add this to your JavaScript file
    document.querySelectorAll('.follow-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`/follow/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button state
                        this.classList.remove('follow-btn');
                        this.classList.add('unfollow-btn');
                        this.textContent = 'Unfollow';
                    }
                });
        });
    });

    document.querySelectorAll('.unfollow-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`/unfollow/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button state
                        this.classList.remove('unfollow-btn');
                        this.classList.add('follow-btn');
                        this.textContent = 'Follow';
                    }
                });
        });
    });
</script>
