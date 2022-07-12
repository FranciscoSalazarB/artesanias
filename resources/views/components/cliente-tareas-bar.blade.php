<div>
    <form action="#">
        <label>
            <input type="radio" name="observable" v-model="picked" value="politicas">
            <span :class="picked== 'politicas' ? 'caltalogoSelected' : ''" class="spanRadioCustom">Ver Políticas de uso</span>
        </label>
        <label>
            <input type="radio" name="observable" v-model="picked" value="main">
            <span :class="picked== 'main' ? 'caltalogoSelected' : ''" class="spanRadioCustom">Datos del Usuario</span>
        </label>
        <label>
            <input type="radio" name="observable" v-model="picked" value="compras">
            <span :class="picked== 'compras' ? 'caltalogoSelected' : ''" class="spanRadioCustom">Compras</span>
        </label>
    </form>
</div>