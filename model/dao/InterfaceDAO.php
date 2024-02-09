<?php

	namespace model\dao;

	interface InterfaceDAO{
		/** load
		* Carga el correspondiente registro de bd y lo devuelve como una entidad.
		* @param int $id Identificado del registro en bd.
		* @return Socio El objeto socio correspondiente.
		*/
		public function load($id);

		/** save
		* Guarda el socio como un nuevo registro en la bd.
		* @param Object $socio Objeto socio se guardará en la bd.
		* @return void
		*/
		public function save($objeto);

		/** update
		* Replica los datos del objeto, en su correpondiente registro de bd.
		* @param Object $socio Objeto socio que se va a actualizar en la bd.
		* @return void
		*/
		public function update($objeto);

		/** delete
		* Elimina un registro de la bd.
		* @param int $id Identificador del registro que se eliminará en bd.
		* @return void
		*/
		public function delete($id);

		/** list
		* Devuelve un listado de socios.
		* @param JSON $filtros Filtros de búsqueda para la consulta SQL.
		*/
		public function list($filtros): array;
}
?>