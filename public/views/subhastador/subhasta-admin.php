<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/subhastador/subhasta.css">
    <link rel="stylesheet" href="views/css/subhastador/dashboard.css" />
    <title>TopBid</title>
    <link rel="icon" href="views/images/icons/logo.ico">
</head>

<body>
    <div class="container">
        <?php include 'views/includes/nav-admin.php'; ?>
        <section class="main">
            <div class="main-top">
                <h1>Subhastes</h1>
            </div>
            <div class="course-box">
                <h3>Que vols fer?</h3>
                <div class="boton">
                    <button class="button" onclick="mostrarFormulari()">Afegir Subhasta</button>
                    <button class="button" onclick="mostrarTaula()">Mostrar Subhasta</button>
                    <button class="button" onclick="mostrarFormulariProductes()">Afegir Productes a Subhasta</button>
                </div>

                <div id="formSubhasta" class="form-container hidden">
                <form method="POST" action="index.php?controller=subhastador&action=createSubhasta">
                        <label for="nom">Nom de la Subhasta:</label>
                        <input type="text" id="nom" name="nom" required maxlength="100">

                        <label for="date_hora">Data i hora:</label>
                        <input type="datetime-local" id="date_hora" name="date_hora" required>

                        <label for="lloc">Lloc:</label>
                        <input type="text" id="lloc" name="lloc" required maxlength="100">

                        <label for="descripcio">Descripció:</label>
                        <textarea id="descripcio" name="descripcio" required maxlength="250"></textarea>

                        <label for="percentatge">Percentatge de comissió de cada producte: (%)</label>
                        <input type="text" id="percentatge" name="percentatge" value="10">

                        <div class="botones">
                            <button type="submit" class="button" value="Enviar">Enviar</button>
                            <button type="button" class="close" onclick="mostrarFormulari()">Close</button>
                        </div>
                    </form>
                </div>

                <div id="taulaSubhasta" class="table-container hidden">
                    <table>
                        <thead>
                            <tr>
                                <th>Id de la Subhasta</th>
                                <th>Nom</th>
                                <th>Data i Hora</th>
                                <th>Lloc</th>
                                <th>Descripció</th>
                                <th>Percentatge de comissió de cada producte (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($subhastes)): ?>
                                <?php foreach ($subhastes as $subhasta): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($subhasta->id_subhasta) ?></td>
                                        <td><?= htmlspecialchars($subhasta->nom) ?></td>
                                        <td><?= htmlspecialchars($subhasta->date_hora) ?></td>
                                        <td><?= htmlspecialchars($subhasta->lloc) ?></td>
                                        <td><?= htmlspecialchars($subhasta->descripcio) ?></td>
                                        <td><?= htmlspecialchars($subhasta->percentatge) ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No hi ha subhastes disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="formProductes" class="form-container hidden">
                    <form method="POST" action="index.php?controller=subhastador&action=addProductsToSubhasta">
                        <label for="id_subhasta">Selecciona Subhasta:</label>
                        <select id="id_subhasta" name="id_subhasta" required>
                            <?php if (empty($subhastesSenseIniciar)): ?>
                                <option value=""><?= htmlspecialchars('No hi ha subhasta disponible') ?></option>
                            <?php else: ?>
                                <?php foreach ($subhastesSenseIniciar as $subhasta): ?>
                                    <option value="<?= htmlspecialchars($subhasta->id_subhasta) ?>">
                                        <?= htmlspecialchars($subhasta->nom) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <label for="productes">Selecciona Productes:</label>

                        <div id="productes" class="checkbox-container">
                            <?php foreach ($products as $product): ?>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="product_<?= htmlspecialchars($product->id_producte) ?>"
                                        name="productes[]" value="<?= htmlspecialchars($product->id_producte) ?>">
                                    <label
                                        for="product_<?= htmlspecialchars($product->id_producte) ?>"><?= htmlspecialchars($product->nom) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="botones">
                            <button type="submit" class="button" value="Afegir Productes">Afegir Productes</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script src="views/scripts/valida-forms/valida-form-subhasta.js"></script>
    <script src="views/scripts/subhastador.js"></script>
</body>

</html>