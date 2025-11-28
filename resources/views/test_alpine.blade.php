<!DOCTYPE html>
<html>
<head>
    <title>Test Alpine</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <div x-data="{ count: 0 }">
        <h1 x-text="count"></h1>
        <button @click="count++">Increment</button>
    </div>
    <script>
        console.log('Test Alpine loaded');
        if (window.Alpine) {
            console.log('Alpine version:', window.Alpine.version);
        }
    </script>
</body>
</html>
