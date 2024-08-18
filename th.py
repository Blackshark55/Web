import tkinter as tk
from tkinter import ttk
from tkinter import messagebox
import datetime

class ReceiptGenerator:
    def __init__(self, root):
        self.root = root
        self.root.title("Receipt Generator")
        self.root.geometry("800x600")

        # Create main frame
        self.main_frame = ttk.Frame(self.root, padding="10 10 10 10")
        self.main_frame.pack(fill="both", expand=True)

        # Create header frame
        self.header_frame = ttk.Frame(self.main_frame, padding="10 10 10 10")
        self.header_frame.pack(fill="x")

        # Create logo label
        self.logo_label = ttk.Label(self.header_frame, text="Receipt Generator", font=("Arial", 24, "bold"))
        self.logo_label.pack(side="left", padx=10)

        # Create date label
        self.date_label = ttk.Label(self.header_frame, text=datetime.date.today().strftime("%B %d, %Y"), font=("Arial", 18))
        self.date_label.pack(side="right", padx=10)

        # Create customer info frame
        self.customer_info_frame = ttk.Frame(self.main_frame, padding="10 10 10 10")
        self.customer_info_frame.pack(fill="x")

        # Create customer name label and entry
        self.customer_name_label = ttk.Label(self.customer_info_frame, text="Customer Name:")
        self.customer_name_label.pack(side="left", padx=10)
        self.customer_name_entry = ttk.Entry(self.customer_info_frame, width=30)
        self.customer_name_entry.pack(side="left", padx=10)

        # Create customer address label and entry
        self.customer_address_label = ttk.Label(self.customer_info_frame, text="Customer Address:")
        self.customer_address_label.pack(side="left", padx=10)
        self.customer_address_entry = ttk.Entry(self.customer_info_frame, width=30)
        self.customer_address_entry.pack(side="left", padx=10)

        # Create items frame
        self.items_frame = ttk.Frame(self.main_frame, padding="10 10 10 10")
        self.items_frame.pack(fill="both", expand=True)

        # Create items treeview
        self.items_treeview = ttk.Treeview(self.items_frame, columns=("Item", "Quantity", "Price", "Total"), show="headings")
        self.items_treeview.pack(fill="both", expand=True)

        # Create items treeview headings
        self.items_treeview.heading("Item", text="Item")
        self.items_treeview.heading("Quantity", text="Quantity")
        self.items_treeview.heading("Price", text="Price")
        self.items_treeview.heading("Total", text="Total")

        # Create add item button
        self.add_item_button = ttk.Button(self.items_frame, text="Add Item", command=self.add_item)
        self.add_item_button.pack(side="bottom", padx=10, pady=10)

        # Create total frame
        self.total_frame = ttk.Frame(self.main_frame, padding="10 10 10 10")
        self.total_frame.pack(fill="x")

        # Create total label and entry
        self.total_label = ttk.Label(self.total_frame, text="Total:")
        self.total_label.pack(side="left", padx=10)
        self.total_entry = ttk.Entry(self.total_frame, width=20)
        self.total_entry.pack(side="left", padx=10)

        # Create generate receipt button
        self.generate_receipt_button = ttk.Button(self.main_frame, text="Generate Receipt", command=self.generate_receipt)
        self.generate_receipt_button.pack(side="bottom", padx=10, pady=10)

    def add_item(self):
        # Get item info from user
        item_name = self.item_name_entry.get()
        quantity = int(self.quantity_entry.get())
        price = float(self.price_entry.get())

        # Calculate total
        total = quantity * price

        # Add item to treeview
        self.items_treeview.insert("", "end", values=(item_name, quantity, price, total))

        # Clear entry fields
        self.item_name_entry.delete(0, "end")
        self.quantity_entry.delete(0, "end")
        self.price_entry.delete(0, "end")

    def generate_receipt(self):
        # Get customer info
        customer_name = self.customer_name_entry.get()
        customer_address = self.customer_address_entry.get()

        # Get items from treeview
        items = []
        for child in self.items_treeview.get_children():
            item = self.items_treeview.item(child)["values"]
            items.append(item)

        # Calculate total
        total = 0
        for item in items:
            total += item[3]

        # Create receipt text
        receipt_text = f"Receipt for {customer_name}\n"
        receipt_text += f"Address: {customer_address}\n\n"
       