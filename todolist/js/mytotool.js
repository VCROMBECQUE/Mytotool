var todos = document.getElementById("todos");
var add_new_todo = document.getElementById("add_new_todo");

document.addEventListener("load", todos_init());

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
          update_todos += ` <div class="todo" id="todo_${current_task.id}">
                            <input type="checkbox" ${
                              current_task.checked == 1 ? `checked` : ``
                            } class="todo_check" id="check_todo_${
            current_task.id
          }" onclick="update_check()">
                            <div class="todo_text texting-1" id="text_todo_${
                              current_task.id
                            }">
                              ${current_task.task}
                            </div>
                              <div class="todo_options">
                                <i class="fas fa-times todo_options_delete" id="delete_todo_${
                                  current_task.id
                                }" onclick="delete_todo()"></i>
                                <div class="todo_options_update">
                                  <i class="fas fa-edit" id="change_todo_${
                                    current_task.id
                                  }" onclick="change_todo()"></i>
                                </div>
                              </div>
                            </div>`;
        });
        update_todos
          ? (todos.innerHTML = update_todos)
          : (todos.innerHTML =
              '<p class="todo_default texting-1">Vous n\'avez aucune tâche à faire !</p>');
      });
    })
    .catch((error) => console.log("erreur fetch", error));
}

async function delete_todo() {
  let elem = window.event.target.id.split("_")[2];
  let todo_del = document.getElementById("todo_" + elem);

  const options = {
    method: "POST",
    body: elem,
  };

  await fetch("../php/db_delete_todo.php", options)
    .then(() => {
      todo_del.remove();

      todos.childElementCount
        ? null
        : (todos.innerHTML =
            '<p class="todo_default texting-1">Vous n\'avez aucune tâche à faire !</p>');
    })
    .catch((error) => console.log("erreur fetch", error));
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
      .then((response) => {
        response.json().then((data) => {
          let numberoftask = todos.getElementsByClassName("todo");

          let new_todo = `<div class="todo" id="todo_${data.id}">
                            <input type="checkbox" class="todo_check" id="check_todo_${data.id}" onclick="update_check()">
                            <div type="text" class="todo_text texting-1" id="text_todo_${data.id}">${data.task}</div>
                            <div class="todo_options">
                              <i class="fas fa-times todo_options_delete" id="delete_todo_${data.id}" onclick="delete_todo()"></i>
                              <div class="todo_options_update">
                                <i class="fas fa-edit todo_options_update" id="change_todo_${data.id}" onclick="change_todo()"></i>
                              </div>
                            </div>
                          </div>`;

          numberoftask.length
            ? (todos.innerHTML += new_todo)
            : (todos.innerHTML = new_todo);
        });
      })
      .catch((error) => console.log("erreur fetch", error));
  }
}

async function update_check() {
  let elem = window.event.target.id.split("_")[2];

  const options = {
    method: "POST",
    body: elem,
  };

  await fetch("../php/db_update_check.php", options).catch((error) =>
    console.log("Erreur lors de la modification du check", error)
  );
}

function change_todo() {
  let elem = window.event.target.id.split("_")[2];
  let todo_change = document.getElementById("text_todo_" + elem);

  todo_change.setAttribute("contentEditable", true);
  todo_change.classList.add("edit_text");
}
