<div>
    <form action="#">
        <label>
            <input v-model="picked" type="radio" name="observable" value="pedidos">
            <span class="spanRadioCustom" :class="picked== 'pedidos' ? 'caltalogoSelected' : ''">Ventas sin confirmar</span>
        </label>
        @if(Auth::user()->roll == "finanzas")
        <label>
            <input v-model="picked" type="radio" name="observable" value="historico">
            <span class="spanRadioCustom" :class="picked== 'historico' ? 'caltalogoSelected' : ''">Histórico</span>
        </label>
        
        <label>
            <input v-model="picked" type="radio" name="observable" value="ajustes">
            <span class="spanRadioCustom" :class="picked== 'ajustes' ? 'caltalogoSelected' : ''">Ajustes del sistema</span>
        </label>
        @endif
        @if(Auth::user()->roll == "almacen")
        <label>
            <input v-model="picked" type="radio" name="observable" value="almacen">
            <span class="spanRadioCustom" :class="picked== 'almacen' ? 'caltalogoSelected' : ''">Almacén</span>
        </label>
        @endif
    </form>
</div>