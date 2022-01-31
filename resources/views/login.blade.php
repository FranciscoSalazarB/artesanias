@extends('plantilla')

@section('body')
    <login inline-template>
        <div class="login">
            <form action="#">
                <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
                <h3>@{{state}}</h3>
                <div class="inputs" v-if="state == 'login'">
                    <span>Usuario</span>
                    <input type="text" v-model="log.name">
                    <span>Contraseña</span>
                    <input type="password" v-model="log.pass">
                </div>
                <div class="inputs" v-if="state == 'registro'">
                    <span>Usuario</span>
                    <input type="text" v-model="reg.name">
                    <span>Correo</span>
                    <input type="gmail" v-model="reg.email">
                    <span>Contraseña</span>
                    <input type="password" v-model="reg.pass1">
                    <span>repetir contraseña</span>
                    <input type="password" v-model="reg.pass2">
                </div>
                <div class="butons">
                    <button>login</button>
                    <button v-on:click="change">Registro</button>
                </div>
            </form>
        </div>
    </login>
@endsection