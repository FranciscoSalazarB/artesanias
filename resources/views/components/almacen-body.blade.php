<div class="almacenBody">
    <div v-if="select == 'ramas'">
        <table>
            <thead>
                <tr>
                    <th>Nombre de la Rama</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>  
                <tr class="newItem">
                    <td><input type="text" v-model="newRama.rama" placeholder="Nombre de la nueva Rama"></td>
                    <td class="option"><button v-on:click="addRama">Agregar nueva rama</button></td>
                </tr>
                <tr v-for="(rama, index) in ramas" v-bind:class="[rama.eliminado ? 'eliminado' : 'activo', index % 2 == 0 ? '' : 'impar']">
                    <td><input type="text" v-model="rama.rama"></td>
                    <td class="option">
                        <button v-on:click="editRama(rama)" v-if="!rama.eliminado">Editar</button>
                        <button v-on:click="delRama(rama)" v-if="!rama.eliminado">Eliminar</button>
                        <button v-on:click="resetRama(rama)" v-if="rama.eliminado">Reintegrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="select == 'rubros'">
        <table>
            <thead>
                <th>Nombre Del Rubro</th>
                <th>Nombre De la Rama</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <tr class="newItem">
                    <td><input type="text" v-model="newRubro.rubro" placeholder="Nombre del nuevo Rubro"></td>
                    <td>
                        <select v-model="newRubro.idRama">
                            <option :value="rama.id" v-for="rama in ramas">@{{rama.rama}}</option>
                        </select>
                    </td>
                    <td class="option"><button v-on:click="addRubro">Agregar un nuevo rubro</button></td>
                </tr>
                <tr v-for="(rubro, index) in rubros" v-bind:class="[rubro.eliminado ? 'eliminado' : 'activo',index % 2 == 0 ? '' : 'impar']">
                    <td><input type="text" v-model="rubro.rubro"></td>
                    <td>@{{findRama(rubro.idRama).rama}}</td>
                    <td class="option">
                        <button v-on:click="editRubro(rubro)" v-if="!rubro.eliminado">Editar</button>
                        <button v-on:click="delRubro(rubro)" v-if="!rubro.eliminado">Eliminar</button>
                        <button v-on:click="resetRubro(rubro)" v-if="rubro.eliminado">Reintegrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="select == 'productos'">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Unidad de Medida</th>
                    <th>Rubro</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="newItem">
                    <td><input type="text" v-model="newProducto.descripcion" placeholder="Nombre de nuevo Producto"></td>
                    <td><input type="text" v-model="newProducto.unidadDeMedida" placeholder="Unidad de medida del nuevo producto"></td>
                    <td>
                        <select select v-model="newProducto.idRubro">
                            <option :value="rubro.id" v-for="rubro in rubros">@{{rubro.rubro}}</option>
                        </select>
                    </td>
                    <td class = "option"><button v-on:click="addProducto">Agregar un nuevo producto</button></td>
                </tr>
                <tr v-for="(producto, index) in productos" v-bind:class="[producto.eliminado ? 'eliminado' : 'activo',index % 2 == 0 ? '' : 'impar']">
                    <td><input type="text" v-model="producto.descripcion"></td>
                    <td><input type="text" v-model="producto.unidadDeMedida"></td>
                    <td>@{{findRubro(producto.idRubro).rubro}} - @{{findRama(findRubro(producto.idRubro).idRama).rama}}</td>
                    <td class="option">
                        <button v-on:click="editProducto(producto)" v-if = "!producto.eliminado">Editar</button>
                        <button v-on:click="delProducto(producto)" v-if = "!producto.eliminado">Eliminar</button>
                        <button v-on:click="resetProducto(producto)" v-if = "producto.eliminado">Reintegrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="select == 'piezas'" id="divPiezas">
        <table id="tablePiezas">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Descripcion</th>
                    <th>Precio En MXN</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="newItem">
                    <td>
                        <div class="imgAdd">
                            <input type="file"  name="newFoto" v-on:change="addImg" accept="image/jpeg, image/png"/>
                        </div>
                    </td>
                    <td>
                        <textarea v-model="newPieza.nombre" placeholder = "Descripción de la pieza" ></textarea>
                    </td>
                    <td><input type="number" v-model="newPieza.precio"></td>
                    <td><input type="text" v-model="newPieza.codigoAlterno" placeholder="Código de la nueva pieza"></td>
                    <td>
                        <select select v-model="newPieza.idProducto">
                            <option :value="producto.id" v-for="producto in productos">@{{producto.descripcion}}</option>
                        </select>
                    </td>
                    <td class="option"><button v-on:click="addPieza">Agregar una nueva Pieza</button></td>
                </tr>
                <tr v-for="(pieza, index) in piezas" v-bind:class="[pieza.estatus == 'eliminado' ? 'eliminado' : 'activo',index % 2 == 0 ? '' : 'impar']">
                    <td><img :src="foto.url + foto.nombreArchivo" v-for="foto in pieza.fotos"></td>
                    <td>
                        <textarea v-model="pieza.nombre"></textarea>
                    </td>
                    <td><input type="number" v-model="pieza.precio"></td>
                    <td><input type="text" v-model="pieza.codigoAlterno"></td>
                    <td>@{{findProducto(pieza.idProducto).descripcion}} - @{{findRubro(findProducto(pieza.idProducto).idRubro).rubro}} - @{{findRama(findRubro(findProducto(pieza.idProducto).idRubro).idRama).rama}}</td>
                    <td class="option">
                        <button v-on:click="editPieza(pieza)" v-if="pieza.estatus == 'activo'">Editar</button>
                        <button v-on:click="delPieza(pieza)" v-if="pieza.estatus == 'activo'">Eliminar</button>
                        <button v-on:click="resetPieza(pieza)" v-if="pieza.estatus == 'eliminado'">Reintegrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>