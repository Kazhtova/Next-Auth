import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import Header from "@/components/header";
import Footer from "@/components/footer";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "Next Blog",
  description: "A simple blog built with Next.js",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body
        className={`${inter.className} bg-zinc-100 text-zinc-900 flex flex-col min-h-screen`}
      >
        <Header />
        <main className="flex-1 max-w-4xl w-full mx-auto p-5 bg-white shadow-sm my-6 rounded-lg">
          {children}
        </main>
        <Footer />
      </body>
    </html>
  );
}