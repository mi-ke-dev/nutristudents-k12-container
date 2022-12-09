export default {

    roundByEight(result){
        return (Math.round((result) * 8) / 8).toFixed(3);
    },

    weight(initialWeight, initialUom, convertToUom) {

        const grams = this.convertToGrams(initialWeight, initialUom)

        const result = this.convertFromGrams(grams, convertToUom)

        return result > 0 ? result : null // closes 0.125 : null

    },

    volume(initialVolume, initialUom, convertToUom) {

        const grams = this.convertToTeaspoons(initialVolume, initialUom)

        const result = this.convertFromTeaspoons(grams, convertToUom)

        return result > 0 ? result : null // closes 0.125 : null

    },

    volumeToWeight(preferredProduct, recipeAmount, recipeUom, newUom) {
        // Convert Recipe Amount / UOM to preferred UOM
        let baseRecipeAmount = this.volume(recipeAmount, recipeUom, preferredProduct.measurement_serving_volume_uom);

        // Convert preferred Weight UOM to preferred Volume UOM
        let scale = preferredProduct.measurement_serving_volume / preferredProduct.measurement_serving_weight;

        // Convert to final volume UOM
        baseRecipeAmount = baseRecipeAmount * scale;

        let result = this.weight(baseRecipeAmount, preferredProduct.measurement_serving_weight_uom, newUom);

        return result

    },

    weightToVolume(preferredProduct, recipeAmount, recipeUom, newUom) {

        // Convert Recipe Amount / UOM to preferred UOM
        let baseRecipeAmount = this.weight(recipeAmount, recipeUom, preferredProduct.measurement_serving_weight_uom);

        // Convert preferred Weight UOM to preferred Volume UOM
        let scale = preferredProduct.measurement_serving_weight / preferredProduct.measurement_serving_volume;

        // Convert to final volume UOM
        baseRecipeAmount = baseRecipeAmount * scale;

        let result = this.volume(baseRecipeAmount, preferredProduct.measurement_serving_volume_uom, newUom);

        return result;

    },

    convertToGrams(initialWeight, initialUom) {

        if (initialUom === 'Gram') {
            return initialWeight;
        }
        if (initialUom === 'Ounce') {
            return initialWeight * 28.34952;
        }
        if (initialUom === 'Pound' || initialUom === 'LB') {
            return initialWeight * 453.59237;
        }

        // error
        return -1;
    },
    convertFromGrams(initialWeight, convertToUom) {

        if (convertToUom === 'Gram') {
            return initialWeight;
        }
        if (convertToUom === 'Ounce') {
            return initialWeight / 28.34952;
        }
        if (convertToUom === 'Pound' || convertToUom === 'LB') {
            return initialWeight / 453.59237;
        }

        // error
        return -1;
    },

    convertToTeaspoons(initialVolume, initialUom) {

        if (initialUom === 'Gallon') {
            return initialVolume * 768
        }
        if (initialUom === 'Quart') {
            return initialVolume * 192;
        }
        if (initialUom === 'Pint') {
            return initialVolume * 96;
        }
        if (initialUom === 'Cup') {
            return initialVolume * 48
        }
        if (initialUom === 'Fluid Ounce') {
            return initialVolume * 6
        }
        if (initialUom === 'Tablespoon') {
            return initialVolume * 3;
        }
        if (initialUom === 'Teaspoon') {
            return initialVolume * 1;
        }

        // error
        return -1;
    },
    convertFromTeaspoons(initialVolume, convertToUom) {

        if (convertToUom === 'Gallon') {
            return initialVolume / 768
        }
        if (convertToUom === 'Quart') {
            return initialVolume / 192;
        }
        if (convertToUom === 'Pint') {
            return initialVolume / 96;
        }
        if (convertToUom === 'Cup') {
            return initialVolume / 48
        }
        if (convertToUom === 'Fluid Ounce') {
            return initialVolume / 6
        }
        if (convertToUom === 'Tablespoon') {
            return initialVolume / 3;
        }
        if (convertToUom === 'Teaspoon') {
            return initialVolume / 1;
        }

        // error
        return -1;
    }
};
