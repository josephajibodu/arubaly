<!-- Footer Start -->
<footer class="footer h-16 flex items-center px-6 bg-white shadow dark:bg-gray-800">
    <div class="flex md:justify-between justify-center w-full gap-4">
        <div>
            <script>document.write(new Date().getFullYear())</script> © Arubaly - <a href="{{ url('/') }}" target="_blank">arubaly.com</a>
        </div>
        <div class="md:flex hidden gap-4 item-center md:justify-end">
            <a href="{{ url('/') }}" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Home</a>
            <span class="border-e border-gray-300 dark:border-gray-700"></span>
            <a href="{{ route('terms-and-conditions') }}" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Terms</a>
            <span class="border-e border-gray-300 dark:border-gray-700"></span>
            <a href="{{ route('become-a-merchant') }}" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Become a Merchant</a>
        </div>
    </div>
</footer>
<!-- Footer End -->
