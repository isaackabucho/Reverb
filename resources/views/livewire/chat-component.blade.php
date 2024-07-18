<div>
    <ul>
        @foreach ($convo as $convoItem)
            <li>{{ $convoItem['username'] }} : {{ $convoItem['message'] }}</li>
        @endforeach
    </ul>

    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" />
        @error('message')
            <p class="text-red-600">{{ $message }}</p>
        @enderror
        <button type="submit">Send</button>
    </form>
    
</div>
