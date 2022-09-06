@extends('base.index')



@foreach($periodos as $p) 
    <div class="mx-auto" style="width: 40%;" id="create">
        <p>{{$p->nome}}</p>
        <table class="table table-striped">
            <thead>
                <tr>
                <th>Resultados gerais</th>
                </tr>
            </thead>
            <tbody>
            @foreach($votos[$p->id] as $v)
                <tr>
                    <td>{{$v->nome}}</td>
                    <td>{{$v->votos}}</td>
                </tr>
            @endforeach
            </tbody>
          
           
            
        </table>
        
    </div>
@endforeach


<!-- <a href="/votos" class="btn btn-danger">Voltar</a> -->