<form id=addItem method="post" enctype="multipart/form-data">
  <h2>Votre Annonce</h2>
    <label for="nom">Nom de l'Article:</label>
    <input type="text" id="nom" name="nom" required>

    <br>

    <label for="prix">Prix :</label>
    <input type="number" id="prix" name="prix" step="1" required>

    <br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="6" maxlength="600" oninput=limiterCaracteres(this) required></textarea>

    <br>

    <label for="image">Images :</label>
    <input type="file" id="image" name="image" accept="image/*">

    <br>

    <button type="submit" name=add>Ajouter Objet</button>
</form>

<script>
    function limiterCaracteres(champ) {
        if (champ.value.length > champ.maxLength) {
            champ.value = champ.value.substring(0, champ.maxLength);
        }
    }
</script>