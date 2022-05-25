<div>
    <div v-if="select == 'ramas'">
        <div v-for="rama in ramas" v-bind:class="rama.eliminado ? 'eliminado' : 'activo'">
            <input type="text" v-model="rama.rama">
            <button v-on:click="editRama(rama)">Editar</button>
            <button v-on:click="delRama(rama)">Eliminar</button>
        </div>
        <div>
            <input type="text" v-model="newRama.rama">
            <button v-on:click="addRama">Agregar nueva rama</button>
        </div>
    </div>
    <div v-if="select == 'rubros'">
        <div v-for="rubro in rubros" v-bind:class="rubro.eliminado ? 'eliminado' : 'activo'">
            <input type="text" v-model="rubro.rubro">
            <p>rama : @{{findRama(rubro.idRama).rama}}</p>
            <button v-on:click="editRubro(rubro)">Editar</button>
            <button v-on:click="delRubro(rubro)">Eliminar</button>
        </div>
        <div>
            <input type="text" v-model="newRubro.rubro">
            <select v-model="newRubro.idRama">
                <option :value="rama.id" v-for="rama in ramas">@{{rama.rama}}</option>
            </select>
            <button v-on:click="addRubro">Agregar un nuevo rubro</button>
        </div>
    </div>
    <div v-if="select == 'productos'">
        <div v-for="producto in productos" v-bind:class="producto.eliminado ? 'eliminado' : 'activo'">
            <input type="text" v-model="producto.descripcion">
            <input type="text" v-model="producto.unidadDeMedida">
            <p>Rubro : @{{findRubro(producto.idRubro).rubro}}</p>
            <button v-on:click="editProducto(producto)">Editar</button>
            <button v-on:click="delProducto(producto)">Eliminar</button>
        </div>
        <div>
            <input type="text" v-model="newProducto.descripcion">
            <input type="text" v-model="newProducto.unidadDeMedida">
            <select select v-model="newProducto.idRubro">
                <option :value="rubro.id" v-for="rubro in rubros">@{{rubro.rubro}}</option>
            </select>
            <button v-on:click="addProducto">Agregar un nuevo producto</button>
        </div>
    </div>
    <div v-if="select == 'piezas'">
        <div v-for="pieza in piezas" v-bind:class="pieza.estatus == 'eliminado' ? 'eliminado' : 'activo'">
            <input type="text" v-model="pieza.nombre">
            <input type="number" v-model="pieza.precio">
            <input type="text" v-model="pieza.codigoAlterno">
            <p>Producto : @{{findProducto(pieza.idProducto).descripcion}}</p>
            <button v-on:click="editPieza(pieza)">Editar</button>
            <button v-on:click="delPieza(pieza)">Eliminar</button>
            <img :src="foto.url + foto.nombreArchivo" v-for="foto in pieza.fotos">
        </div>
        <div>
            <input type="text" v-model="newPieza.nombre">
            <input type="number" v-model="newPieza.precio">
            <input type="text" v-model="newPieza.codigoAlterno">
            <select select v-model="newPieza.idProducto">
                <option :value="producto.id" v-for="producto in productos">@{{producto.descripcion}}</option>
            </select>
            <button v-on:click="addPieza">Agregar un nuevo producto</button>
        </div>
    </div>
</div>