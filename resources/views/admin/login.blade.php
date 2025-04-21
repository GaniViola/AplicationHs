<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   DashDaddy Login
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#F5FAFB] min-h-screen flex items-center justify-center p-4">
  <main class="bg-white w-full max-w-sm p-10 drop-shadow-md">
   <div class="flex flex-col items-center mb-8">
    <img alt="DashDaddy logo with three dots above text" class="mb-2" height="20" src="https://storage.googleapis.com/a1aa/image/b499c620-e4b3-4603-bb83-83e47d561714.jpg" width="40"/>
    <h1 class="font-extrabold text-lg text-black">
     DASHDADDY
    </h1>
   </div>
   <form method="POST" action="{{ url('/secure-area/login') }}" class="space-y-6">
    @csrf

    @if ($errors->any())
        <div class="text-red-500 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="relative">
        <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-300"></i>
        <input name="username" value="{{ old('username') }}" class="w-full ..." placeholder="Username" type="text" />
    </div>
    <div class="relative">
        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-300"></i>
        <input name="password" class="w-full ..." placeholder="Password" type="password" />
        <i class="fas fa-eye-slash absolute right-3 top-1/2 -translate-y-1/2 text-gray-300"></i>
    </div>

    <button type="submit" class="w-full py-3 ...">
        LOGIN
    </button>
</form>
  </main>
 </body>
</html>
