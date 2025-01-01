<x-app-layout>
    <div class="flex items-start justify-center min-h-screen bg-blue-300 dark:bg-slate-950">
        <div
            class="flex justify-center w-11/12 h-full mt-24 rounded-lg shadow-lg  bg-sky-100 dark:bg-slate-900 dark:text-slate-50 text-slate-900 lg:w-4/5 sm:w-11/12">

            <div class="flex flex-col w-full">
                <div class="flex justify-center w-4/5 h-32 mx-auto mt-10 border-indigo-600 rounded-lg bg-fuchsia-400">
                    Background DP
                </div>
                <div class="flex justify-center mx-auto -mt-12 rounded-full w-28 h-28 bg-fuchsia-900">
                    DP
                </div>
                <div class="flex justify-center w-4/5 h-8 mx-auto mt-1 bg-transparent rounded-lg">
                    <p class="text-xl font-semibold text-indigo-600"> {{ $username->name }} </p>
                </div>
                <div
                    class="flex justify-center w-4/5 h-auto mx-auto mt-1 bg-transparent rounded-lg min-h-20 lg:max-h-32">
                    <p>
                        {!! nl2br($userdetails->bio) !!}
                    </p>
                </div>

                <div class="flex justify-center w-full p-2 m-2 mx-auto lg:w-4/5">
                    <div class="flex justify-around w-full mx-auto lg:w-2/3">
                        <div class="w-full text-center border-r">
                            {{ $userdetails->blogpostcount }}<br>
                            Posts

                        </div>
                        <div class="w-full text-center">
                            <span id="followers-count">{{ $userdetails->followers()->count() }}</span><br>
                            Followers
                        </div>

                        <div class="w-full text-center border-l">
                            {{ $userdetails->following }}<br>
                            Following
                        </div>
                    </div>
                </div>

                <h1><?php echo auth()->id(), '<br>';
                echo $userdetails->user_id;
                ?> </h1>

                {{-- Conditional rendering for buttons --}}
                @csrf
                @if (auth()->id() !== $userdetails->user_id)
                    <div
                        class="flex flex-col justify-center w-4/5 mx-auto mt-12 mb-4 space-y-4 sm:flex-row sm:space-x-5 sm:space-y-0">
                        <div class="flex justify-end w-full h-10">


                            <button id="follow-btn"
                                class="w-full py-2 text-center text-white bg-blue-400 rounded-lg min-w-32 lg:w-1/2 sm:w-1/5 hover:bg-blue-500"
                                data-user-id="{{ $userdetails->user_id }}">
                                {{-- {{ auth()->user()->isFollowing($userdetails->user_id)? 'Unfollow': 'Follow' }} --}}
                            </button>

                        </div>
                        <div class="flex justify-start w-full h-10 sm:flex-row">
                            <button
                                class="w-full py-2 text-center text-white bg-blue-400 rounded-lg min-w-32 lg:w-1/2 sm:w-1/5 hover:bg-blue-500">
                                Message
                            </button>
                            <button
                                class="flex justify-center w-auto px-1 py-2 ml-4 border-2 border-black rounded-lg sm:w-auto dark:border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#60A5FA">
                                    <path
                                        d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- @extends('blog.showblog') --}}
</x-app-layout>
<script>
    document.getElementById('follow-btn').addEventListener('click', async function() {
        const userId = this.getAttribute('data-user-id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const action = this.textContent.trim().toLowerCase(); // Follow or Unfollow

        try {
            const response = await fetch(`/bloguser/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    action
                })
            });

            if (response.ok) {
                const data = await response.json();
                // Toggle button text
                this.textContent = action === 'follow' ? 'Unfollow' : 'Follow';
                // Update the followers count dynamically
                document.getElementById('followers-count').textContent = data.followers;
            } else {
                console.error('Failed to update follow status:', response.statusText);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>
