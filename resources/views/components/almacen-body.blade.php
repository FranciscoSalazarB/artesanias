<div class="almacenBody">
    <div v-if="select == 'ramas'">
        <div v-for="rama in ramas" v-bind:class="rama.eliminado ? 'eliminado' : 'activo'" class="crudContainer">
            <div>
                <p>Nombre : </p>
                <input type="text" v-model="rama.rama">
            </div>
            <div>
                <button v-on:click="editRama(rama)" v-if="!rama.eliminado">Editar</button>
                <button v-on:click="delRama(rama)" v-if="!rama.eliminado">Eliminar</button>
                <button v-on:click="resetRama(rama)" v-if="rama.eliminado">Reintegrar</button>
            </div>
        </div>
        <div class="crudContainer">
            <div>
                <p>Nombre : </p>
                <input type="text" v-model="newRama.rama">
            </div>
            <div>
                <button v-on:click="addRama">Agregar nueva rama</button>
            </div>
        </div>
    </div>
    <div v-if="select == 'rubros'">
        <div v-for="rubro in rubros" v-bind:class="rubro.eliminado ? 'eliminado' : 'activo'" class="crudContainer">
            <div>
                <p>Nombre : </p>
                <input type="text" v-model="rubro.rubro">
                <p>rama : @{{findRama(rubro.idRama).rama}}</p>
            </div>
            <div>
                <button v-on:click="editRubro(rubro)" v-if="!rubro.eliminado">Editar</button>
                <button v-on:click="delRubro(rubro)" v-if="!rubro.eliminado">Eliminar</button>
                <button v-on:click="resetRubro(rubro)" v-if="rubro.eliminado">Reintegrar</button>
            </div>
        </div>
        <div class="crudContainer">
            <div>
                <p>Nombre : </p>
                <input type="text" v-model="newRubro.rubro">
                <p>Rama : </p>
                <select v-model="newRubro.idRama">
                    <option :value="rama.id" v-for="rama in ramas">@{{rama.rama}}</option>
                </select>
            </div>
            <div>
                <button v-on:click="addRubro">Agregar un nuevo rubro</button>
            </div>
        </div>
    </div>
    <div v-if="select == 'productos'">
        <div v-for="producto in productos" v-bind:class="producto.eliminado ? 'eliminado' : 'activo'" class="crudContainer">
            <div>
                <p>Descripción : </p>
                <input type="text" v-model="producto.descripcion">
                <p>Unidad de medida : </p>
                <input type="text" v-model="producto.unidadDeMedida">
                <p>Rubro : @{{findRubro(producto.idRubro).rubro}}</p>
            </div>
            <div>
                <button v-on:click="editProducto(producto)" v-if = "!producto.eliminado">Editar</button>
                <button v-on:click="delProducto(producto)" v-if = "!producto.eliminado">Eliminar</button>
                <button v-on:click="resetProducto(producto)" v-if = "producto.eliminado">Reintegrar</button>
            </div>
        </div>
        <div class="crudContainer">
            <div>
                <p>Descripción : </p>
                <input type="text" v-model="newProducto.descripcion">
                <p>Unidad de medida : </p>
                <input type="text" v-model="newProducto.unidadDeMedida">
                <p>Rubro : </p>
                <select select v-model="newProducto.idRubro">
                    <option :value="rubro.id" v-for="rubro in rubros">@{{rubro.rubro}}</option>
                </select>
            </div>
            <div>
                <button v-on:click="addProducto">Agregar un nuevo producto</button>
            </div>
        </div>
    </div>
    <div v-if="select == 'piezas'">
        <div v-for="pieza in piezas" v-bind:class="pieza.estatus == 'eliminado' ? 'eliminado' : 'activo'">
            <div class="crudContainer">
                <div>
                    <p>Nombre : </p>
                    <input type="text" v-model="pieza.nombre">
                    <p>Precio : $</p>
                    <input type="number" v-model="pieza.precio">
                    <p>Códico alterno : </p>
                    <input type="text" v-model="pieza.codigoAlterno">
                </div>
                <div>
                    <button v-on:click="editPieza(pieza)" v-if="pieza.estatus == 'activo'">Editar</button>
                    <button v-on:click="delPieza(pieza)" v-if="pieza.estatus == 'activo'">Eliminar</button>
                    <button v-on:click="resetPieza(pieza)" v-if="pieza.estatus == 'eliminado'">Reintegrar</button>
                </div>
            </div>
            <div>
                <div>
                    <p>Producto : @{{findProducto(pieza.idProducto).descripcion}}</p>
                </div>
            </div>
            <div class="imgContainer">
                <img :src="foto.url + foto.nombreArchivo" v-for="foto in pieza.fotos">
                <div class="imgAdd">
                    <input type="file" :id="pieza.id" name="newFoto" v-on:change="addImg" accept="image/jpeg, image/png"/>
                </div>
            </div>
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