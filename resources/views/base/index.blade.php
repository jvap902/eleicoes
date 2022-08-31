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
