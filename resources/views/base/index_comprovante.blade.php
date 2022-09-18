<!DOCTYPE html>
<html lang="pt-br">
@include('base.header', ['title' => 'Eleições'])

<body>
    <div class="mx-auto" style="width: 40%;" id="btns">
        @yield('container')
    </div>

    @include('base.footer')

</body>

</html>
<script>
    onload = async () => {

        setTimeout(function() {
            window.location.href = 'http://127.0.0.1:8000/votos/resultados';
        }, 3000)
    }
</script>