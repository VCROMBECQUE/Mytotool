let todos = document.getElementById("todos")

function delete_todo() {
    let elem_id = window.event.target.id
    let elem = elem_id.split('_')
    let todo_del = document.getElementById('todo_'+elem[2])
    todos.removeChild(todo_del)

    const options = {
        method: "POST",
        body: elem[2]
    }
    
    fetch('../php/db_delete_todo.php', options)
        .catch(error => console.log('erreur de fetch', error))
}