 <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
 <?php if (isset($mensaje_error)) : ?>
                            <div class="alert alert-danger">
                                <?= $mensaje_error ?>
                            </div>
                        <?php endif; ?>