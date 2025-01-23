// support.js

// Sample data for support tickets (In a real-world scenario, you'd fetch this from a database)
const supportTickets = [
    {
        title: "Issue with logging in",
        description: "I can't log into my account. It keeps saying incorrect password, but I'm sure it's right.",
        status: "Open"
    },
    {
        title: "App crashes on start",
        description: "Every time I try to open the app, it crashes. This has been happening for the last few days.",
        status: "Closed"
    }
];

// Display tickets on page load
function displayTickets() {
    const ticketList = document.getElementById('ticketList');
    ticketList.innerHTML = ''; // Clear the list before displaying

    supportTickets.forEach(ticket => {
        const ticketElement = document.createElement('div');
        ticketElement.classList.add('support-ticket');

        ticketElement.innerHTML = `
            <div class="ticket-title">${ticket.title}</div>
            <div class="ticket-description">${ticket.description}</div>
            <div class="ticket-status">
                <strong>Status: </strong><span class="${ticket.status === 'Open' ? 'text-danger' : 'text-success'}">${ticket.status}</span>
            </div>
        `;

        // Append ticket to the list
        ticketList.appendChild(ticketElement);
    });
}

// Handle ticket submission
document.getElementById("supportForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const title = document.getElementById("issueTitle").value;
    const description = document.getElementById("issueDescription").value;

    if (title.trim() !== "" && description.trim() !== "") {
        // Add new ticket to the supportTickets array (In a real app, this would be stored in a database)
        supportTickets.push({ title, description, status: "Open" });

        // Reset the form and display the updated tickets
        document.getElementById("supportForm").reset();
        displayTickets();
    }
});

// Initial display of tickets
displayTickets();
