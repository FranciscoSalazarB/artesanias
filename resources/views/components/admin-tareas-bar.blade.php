<div>
    <form action="#">
        <label>
            <input v-model="picked" type="radio" name="observable" value="pedidos" checked >
            <span>Ventas sin confirmar</span>
        </label>
        <label>
            <input v-model="picked" type="radio" name="observable" value="almacen">
            <span>Almacén</span>
        </label>
        <label>
            <input v-model="picked" type="radio" name="observable" value="ajustes">
            <span>Ajustes del sistema</span>
        </label>
    </form>
</div>