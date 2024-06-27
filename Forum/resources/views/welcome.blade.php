@extends('layouts.header_footer')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
        
    <div class="container">
        <div class="titlePost">
            <h1>Feed</h1>
        </div>
        <div class="containerAllPosts">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-list">
                        <div class="textPost">
                            <div class="texth2">
                                <h2>Josias Johnson</h2>
                            </div>

                            <h4>Css question</h4>
                            <p>Estou enfrentando um problema relacionado à especificidade dos seletores CSS em meu projeto e gostaria de uma ajuda para entender o que estou fazendo de errado. 
                            Tenho várias regras CSS que parecem estar em conflito e não estou conseguindo fazer com que o estilo desejado seja aplicado corretamente.</p>
                            <p>Tags: #tag1, #tag2, #tag3, #tag4, #tag5</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="user-list">
                        <div class="textPost">
                            <div class="texth2">
                                <h2>Josias Johnson</h2>
                            </div>

                            <h4>Css question</h4>
                            <p>Estou enfrentando um problema relacionado à especificidade dos seletores CSS em meu projeto e gostaria de uma ajuda para entender o que estou fazendo de errado. 
                            Tenho várias regras CSS que parecem estar em conflito e não estou conseguindo fazer com que o estilo desejado seja aplicado corretamente.</p>
                            <p>Tags: #tag1, #tag2, #tag3, #tag4, #tag5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
