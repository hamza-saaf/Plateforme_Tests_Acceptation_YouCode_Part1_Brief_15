<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">
                Quiz Challenge in 
            </h1>
            {{-- {{ route('quiz.submit') }} --}}
            <form method="POST" action="">
                @csrf
                <div class="mb-6">
                    <p class="text-lg font-semibold mb-4 text-gray-700">
                        What is the capital of France?
                    </p>
                    
                    <div class="space-y-4">
                        @php
                        $answers = [
                            ['id' => 1, 'text' => 'London'],
                            ['id' => 2, 'text' => 'Berlin'],
                            ['id' => 3, 'text' => 'Paris'],
                            ['id' => 4, 'text' => 'Madrid']
                        ];
                        @endphp
                        
                        @foreach($answers as $answer)
                            <div>
                                <input 
                                    type="radio" 
                                    name="answer" 
                                    id="answer{{ $answer['id'] }}" 
                                    value="{{ $answer['id'] }}" 
                                    class="hidden peer"
                                >
                                <label 
                                    for="answer{{ $answer['id'] }}" 
                                    class="block w-full py-3 px-4 text-left rounded-lg cursor-pointer 
                                    bg-gray-200 text-gray-700 hover:bg-gray-300
                                    peer-checked:bg-blue-500 peer-checked:text-white"
                                >
                                    {{ $answer['text'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <button 
                    type="submit" 
                    class="w-full py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700"
                >
                    Submit Answer
                </button>
            </form>
            
            @if(session('result'))
                <div class="mt-4 p-4 rounded-lg text-center font-semibold 
                    {{ session('result') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ session('result') ? 'Correct! Great job!' : 'Incorrect. Try again!' }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>