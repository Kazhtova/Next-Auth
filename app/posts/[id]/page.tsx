import { notFound } from "next/navigation";
import db from "@/lib/db";

export const instant = false;

type PostPageProps = {
  params: Promise<{ id: string }>;
};

export default async function PostPage({ params }: PostPageProps) {
  const { id } = await params;

  const post = await db.post.findUnique({
    where: {
      id: parseInt(id),
    },
  });

  if (!post) {
    notFound();
  }

  return (
    <article className="px-7 pt-12 text-center space-y-5">
      <h1 className="text-4xl font-bold">{post.title}</h1>
      <p className="max-w-[700px] mx-auto leading-8 text-zinc-700">
        {post.content}
      </p>
    </article>
  );
}