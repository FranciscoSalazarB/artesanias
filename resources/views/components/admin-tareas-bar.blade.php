<div>
    <form action="#">
        <label>
            <input v-model="picked" type="radio" name="observable" value="pedidos">
            <span class="spanRadioCustom" :class="picked== 'pedidos' ? 'caltalogoSelected' : ''">Ventas sin confirmar</span>
        </label>
        <label>
            <input v-model="picked" type="radio" name="observable" value="historico">
            <span class="spanRadioCustom" :class="picked== 'historico' ? 'caltalogoSelected' : ''">Histórico</span>
        </label>
        <label>
            <input v-model="picked" type="radio" name="observable" value="almacen">
            <span class="spanRadioCustom" :class="picked== 'almacen' ? 'caltalogoSelected' : ''">Almacén</span>
        </label>
        <label>
            <input v-model="picked" type="radio" name="observable" value="ajustes">
            <span class="spanRadioCustom" :class="picked== 'ajustes' ? 'caltalogoSelected' : ''">Ajustes del sistema</span>
        </label>
    </form>
</div>