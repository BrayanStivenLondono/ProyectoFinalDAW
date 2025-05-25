@if(!Cookie::get('cookies_aceptadas'))
    <div id="cookie-banner" style="position: fixed; bottom: 0; width: 100%; background-color: #222; color: white; padding: 1rem; text-align: center; z-index: 1000;">
        Este sitio web utiliza cookies para mejorar la experiencia del usuario.
        <button onclick="aceptarCookies()" style="margin-left: 10px; background-color: #4CAF50; color: white; border: none; padding: 8px 16px; cursor: pointer;">
            Aceptar
        </button>
    </div>
@endif

<script>
    function aceptarCookies() {
        // Enviamos una petición a Laravel para guardar la cookie
        fetch("{{ route('cookies.aceptar') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({})
        }).then(() => {
            document.getElementById('cookie-banner').remove();
        });
    }
</script>
