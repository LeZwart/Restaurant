const food_display = document.getElementById('food-display');

function show_food(i) {
    const path = `../img/showcase_images/${i}.jpg`;

    food_display.getAttributeNode('src').value = path;
}

let imglist = [0, 1];

let i = 0;
setInterval(() => {
    show_food(i);
    i++;
    if (imglist.includes(i) == false) {
        i = 0;
    }

}, 3000);