var todos = document.getElementById("todos");
var add_new_todo = document.getElementById("add_new_todo");

document.addEventListener('load', todos_init());

async function todos_init() {
  let user = document.getElementById("user").innerHTML;

  const options = {
    method: "POST",
    body: JSON.stringify(user),
  };
  
  await fetch("../php/db_todos_init.php", options)
    .then((response) => {
      response.json().then((data) => {
        let update_todos = "";
        data.forEach((current_task) => {
          update_todos += `<div class="todo" draggable="true" id="todo_` + current_task.id + `"><input type="checkbox" `;
          current_task.checked == 1 ? (update_todos += `checked`) : (update_todos += ``);
          update_todos += ` class="todo_check" id="check_todo_` + current_task.id + `" onclick="update_check()">
          <input type="text" class="todo_text texting-1" value="` + current_task.task + `" readonly="readonly">
          <div class="todo_options">
          <i class="fas fa-times todo_options_delete" id="delete_todo_` + current_task.id + `" onclick="delete_todo()"></i>
          <i class="fas fa-edit todo_options_update" id="update_todo_` + current_task.id + `" onclick="update_todo()"></i>
          </div>
          </div>`;
        });
        update_todos ? todos.innerHTML = update_todos : todos.innerHTML = "<p class=\"todo_default texting-1\">Vous n'avez aucune tâche à faire !</p>"
      });
    })
    .catch((error) => console.log("erreur fetch", error));
}

async function delete_todo() {
  let elem_id = window.event.target.id;
  let elem = elem_id.split("_");
  let todo_del = document.getElementById("todo_" + elem[2]);
  // todos.removeChild(todo_del);

  const options = {
    method: "POST",
    body: elem[2],
  };

  await fetch("../php/db_delete_todo.php", options).catch((error) =>
    console.log("erreur fetch", error)
  );

  todos_init();
}

async function add_todo() {
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

    await fetch("../php/db_add_todo.php", options)
      //   .then((response) => {
      //     response.json().then((data) => {
      //       new_todo = `<div class="todo" id="todo_${data.id}">
      //         <input type="checkbox" `;
      //       data.checked ? (new_todo += `checked`) : (new_todo += ``);
      //       new_todo += ` class="todo_check" id="check_todo_${data.id}" onclick="update_check()">
      //     <p class="todo_text texting-1">${data.task}</p>
      //     <i class="fas fa-times todo_delete" id="delete_todo_${data.id}" onclick="delete_todo()"></i>
      // </div>`;
      //       todos.innerHTML += new_todo;
      //     });
      //   })
      .catch((error) => console.log("erreur fetch", error));
  }

  todos_init();
}

async function update_check() {
  let elem_id = window.event.target.id;
  let elem = elem_id.split("_");

  const options = {
    method: "POST",
    body: elem[2],
  };

  await fetch("../php/db_update_check.php", options)
    .catch((error) =>
      console.log("Erreur lors de la modification du check", error)
    );

  todos_init();
}

