const food_display = document.getElementById('food-display');

function show_food(i) {
    const path = `../img/showcase_images/${i}.jpg`;

    food_display.getAttributeNode('src').value = path;
}

let imglist = [0, 1, 2, 3, 4, 5, 6, 7, 8];
  //    Ja, ik zou het allemaal mooi kunnen maken en het aan de database kunnen koppelen
 //     maar daar heb ik geen tijd voor :(
//      waarschijnlijk niet, misschien later :)

let i = 7;
setInterval(() => {
    show_food(i);
    i++;
    if (imglist.includes(i) == false) {
        i = 0;
    }

}, 3000);