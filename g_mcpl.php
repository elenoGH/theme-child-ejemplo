<?php

/*
Template Name: Grafica MCPL
*/
get_header(); ?>
 
<div id="main-content" class="main-content">
 
 
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
				

                    <div>
                        <label class="text-uppercase">Nivel de Gobierno</label>
                        <select class="form-control" name="nivel-gobierno" id="nivel-gobierno">
                            <option value="">-- Todas</option>
                            <option value="federal">Federal</option>
                            <option value="estatal">Estatal</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-uppercase">Cargo</label>
                        <select class="form-control" name="cargo" id="cargo">
                            <option value="">-- Todas</option>
                            <option value="Diputaciones">Diputaciones</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-uppercase">Entidad Federativa</label>
                        <select class="form-control" name="entidad-federativa-mcpl" id="entidad-federativa-mcpl">
                            <option value="" selected="selected">-- Todas</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Ciudad de México">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="México">México</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-uppercase">Partido Politico</label>
                        <select class="form-control" name="partido-politico" id="partido-politico">
                            <option value="">--Todos</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-uppercase">P. de representación</label>
                        <select class="form-control" name="principio-rep" id="principio-rep">
                            <option value="">--Todos</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-uppercase">Propietario/Suplente</label>
                        <select class="form-control" name="prop-sup" id="prop-sup">
                            <option value="">--Todos</option>
                            <option value="Propietario">Propietario/a</option>
                            <option value="Suplente">Suplente</option>
                        </select>
                    </div>
                    <div style="margin-top: 20px; margin-bottom: 20px;text-align: right;">
                        <button name="search-data-mc" type="button"
                                id="search-data-mc"
                                class="btn btn-primary">
                            &nbsp;Buscar</button>
                    </div>
            </section>
        </div>
			
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
 
<?php
get_sidebar();
get_footer();