var todos = document.getElementById("todos");
var add_new_todo = document.getElementById("add_new_todo");

function delete_todo() {
  let elem_id = window.event.target.id;
  let elem = elem_id.split("_");
  let todo_del = document.getElementById("todo_" + elem[2]);
  todos.removeChild(todo_del);

  const options = {
    method: "POST",
    body: elem[2],
  };

  fetch("../php/db_delete_todo.php", options).catch((error) =>
    console.log("erreur fetch", error)
  );
}

function add_todo() {
  let tache = document.getElementById("tache").value;
  let user = document.getElementById("user").innerHTML;
  if (tache) {
    const data = {
      user,
      tache,
    };
    const options = {
      method: "POST",
      body: JSON.stringify(data),
    };

    fetch("../php/db_add_todo.php", options)
      .then((response) => {
        response.json().then((data) => {
          new_todo = `<div class="todo" id="todo_${data.id}">
            <input type="checkbox" `;
          data.checked ? (new_todo += `checked`) : (new_todo += ``);
          new_todo += ` class="todo_check">
        <p class="todo_text texting-1">${data.task}</p>
        <i class="fas fa-times todo_delete" id="delete_todo_${data.id}" onclick="delete_todo()"></i>
    </div>`;
          console.log(new_todo);
          todos.innerHTML += new_todo;
        });
      })
      .catch((error) => console.log("erreur fetch", error));
  }
}

function update_check() {
  let elem_id = window.event.target.id;
  let elem = elem_id.split("_");

  const options = {
    method: "POST",
    body: elem[2],
  };

  fetch("../php/db_update_check.php", options).catch((error) =>
    console.log("erreur fetch", error)
  );
}
