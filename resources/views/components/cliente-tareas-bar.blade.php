<div>
    <form action="#">
        <label>
            <input type="radio" name="observable" v-model="picked" value="main">
            <span :class="picked== 'main' ? 'caltalogoSelected' : ''" class="spanRadioCustom">Usuario</span>
        </label>
        <label>
            <input type="radio" name="observable" v-model="picked" value="compras">
            <span :class="picked== 'compras' ? 'caltalogoSelected' : ''" class="spanRadioCustom">Compras</span>
        </label>
    </form>
</div>