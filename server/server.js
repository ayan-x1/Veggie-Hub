require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const bodyParser = require('body-parser');
const Contact = require('../models/Contact'); // Import the model

const Order = require('../models/order'); // Import the Order model

const app = express();

// Middleware
app.use(cors());
app.use(bodyParser.json());
app.use(express.static('public')); // Serve static files

// Connect to MongoDB
mongoose.connect(process.env.MONGO_URI)
    .then(() => console.log('MongoDB connected'))
    .catch(err => console.log('MongoDB Connection Error:', err));


// Handle Contact Form Submission
app.post('/contact', async (req, res) => {
    try {
        const { name, email, subject, message } = req.body;
        const newContact = new Contact({ name, email, subject, message });
        await newContact.save();
        res.json({ success: true, message: 'Your message has been sent successfully!' });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Error saving data', error });
    }
});


app.get('/track-order/:id', async (req, res) => {
    try {
        const orderId = req.params.id;

        // Convert string ID to ObjectId
        if (!mongoose.Types.ObjectId.isValid(orderId)) {
            return res.json({ success: false, message: "Invalid Order ID" });
        }

        const order = await Order.findById(orderId);

        if (!order) {
            return res.json({ success: false, message: "Order Not Found" });
        }

        res.json({ success: true, order });
    } catch (error) {
        res.status(500).json({ success: false, message: "Error fetching order", error });
    }
});




// Start the Server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
